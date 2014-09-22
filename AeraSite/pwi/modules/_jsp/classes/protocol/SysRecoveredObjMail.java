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
/*    */ public final class SysRecoveredObjMail extends Protocol
/*    */ {
/*    */   public int tid;
/*    */   public byte sys_type;
/*    */   public int receiver;
/*    */   public Octets title;
/*    */   public Octets context;
/*    */   public Octets obj;
/*    */   public Octets checksum;
/*    */ 
/*    */   public SysRecoveredObjMail()
/*    */   {
/* 20 */     this.title = new Octets();
/* 21 */     this.context = new Octets();
/* 22 */     this.obj = new Octets();
/* 23 */     this.checksum = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 28 */     os.marshal(this.tid);
/* 29 */     os.marshal(this.sys_type);
/* 30 */     os.marshal(this.receiver);
/* 31 */     os.marshal(this.title);
/* 32 */     os.marshal(this.context);
/* 33 */     os.marshal(this.obj);
/* 34 */     os.marshal(this.checksum);
/* 35 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 40 */     this.tid = os.unmarshal_int();
/* 41 */     this.sys_type = os.unmarshal_byte();
/* 42 */     this.receiver = os.unmarshal_int();
/* 43 */     os.unmarshal(this.title);
/* 44 */     os.unmarshal(this.context);
/* 45 */     os.unmarshal(this.obj);
/* 46 */     os.unmarshal(this.checksum);
/* 47 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 54 */       SysRecoveredObjMail o = (SysRecoveredObjMail)super.clone();
/* 55 */       o.title = ((Octets)this.title.clone());
/* 56 */       o.context = ((Octets)this.context.clone());
/* 57 */       o.obj = ((Octets)this.obj.clone());
/* 58 */       o.checksum = ((Octets)this.checksum.clone());
/* 59 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 62 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.SysRecoveredObjMail
 * JD-Core Version:    0.6.2
 */