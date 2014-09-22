/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class SysSendMail extends Protocol
/*    */ {
/*    */   public int tid;
/*    */   public int sysid;
/*    */   public byte sys_type;
/*    */   public int receiver;
/*    */   public Octets title;
/*    */   public Octets context;
/*    */   public GRoleInventory attach_obj;
/*    */   public int attach_money;
/*    */ 
/*    */   public SysSendMail()
/*    */   {
/* 21 */     this.title = new Octets();
/* 22 */     this.context = new Octets();
/* 23 */     this.attach_obj = new GRoleInventory();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 28 */     os.marshal(this.tid);
/* 29 */     os.marshal(this.sysid);
/* 30 */     os.marshal(this.sys_type);
/* 31 */     os.marshal(this.receiver);
/* 32 */     os.marshal(this.title);
/* 33 */     os.marshal(this.context);
/* 34 */     os.marshal(this.attach_obj);
/* 35 */     os.marshal(this.attach_money);
/* 36 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 41 */     this.tid = os.unmarshal_int();
/* 42 */     this.sysid = os.unmarshal_int();
/* 43 */     this.sys_type = os.unmarshal_byte();
/* 44 */     this.receiver = os.unmarshal_int();
/* 45 */     os.unmarshal(this.title);
/* 46 */     os.unmarshal(this.context);
/* 47 */     os.unmarshal(this.attach_obj);
/* 48 */     this.attach_money = os.unmarshal_int();
/* 49 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 56 */       SysSendMail o = (SysSendMail)super.clone();
/* 57 */       o.title = ((Octets)this.title.clone());
/* 58 */       o.context = ((Octets)this.context.clone());
/* 59 */       o.attach_obj = ((GRoleInventory)this.attach_obj.clone());
/* 60 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 63 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.SysSendMail
 * JD-Core Version:    0.6.2
 */