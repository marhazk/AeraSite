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
/*    */ public final class PrivateChat extends Protocol
/*    */ {
/*    */   public byte channel;
/*    */   public byte emotion;
/*    */   public Octets src_name;
/*    */   public int srcroleid;
/*    */   public Octets dst_name;
/*    */   public int dstroleid;
/*    */   public Octets msg;
/*    */   public Octets data;
/*    */   public int src_level;
/*    */ 
/*    */   public PrivateChat()
/*    */   {
/* 22 */     this.src_name = new Octets();
/* 23 */     this.dst_name = new Octets();
/* 24 */     this.msg = new Octets();
/* 25 */     this.data = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 30 */     os.marshal(this.channel);
/* 31 */     os.marshal(this.emotion);
/* 32 */     os.marshal(this.src_name);
/* 33 */     os.marshal(this.srcroleid);
/* 34 */     os.marshal(this.dst_name);
/* 35 */     os.marshal(this.dstroleid);
/* 36 */     os.marshal(this.msg);
/* 37 */     os.marshal(this.data);
/* 38 */     os.marshal(this.src_level);
/* 39 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 44 */     this.channel = os.unmarshal_byte();
/* 45 */     this.emotion = os.unmarshal_byte();
/* 46 */     os.unmarshal(this.src_name);
/* 47 */     this.srcroleid = os.unmarshal_int();
/* 48 */     os.unmarshal(this.dst_name);
/* 49 */     this.dstroleid = os.unmarshal_int();
/* 50 */     os.unmarshal(this.msg);
/* 51 */     os.unmarshal(this.data);
/* 52 */     this.src_level = os.unmarshal_int();
/* 53 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 60 */       PrivateChat o = (PrivateChat)super.clone();
/* 61 */       o.src_name = ((Octets)this.src_name.clone());
/* 62 */       o.dst_name = ((Octets)this.dst_name.clone());
/* 63 */       o.msg = ((Octets)this.msg.clone());
/* 64 */       o.data = ((Octets)this.data.clone());
/* 65 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 68 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.PrivateChat
 * JD-Core Version:    0.6.2
 */