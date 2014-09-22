/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GRoleForbid extends Rpc.Data
/*    */ {
/*    */   public byte type;
/*    */   public int time;
/*    */   public int createtime;
/*    */   public Octets reason;
/*    */ 
/*    */   public GRoleForbid()
/*    */   {
/* 17 */     this.reason = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.type);
/* 23 */     os.marshal(this.time);
/* 24 */     os.marshal(this.createtime);
/* 25 */     os.marshal(this.reason);
/* 26 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 31 */     this.type = os.unmarshal_byte();
/* 32 */     this.time = os.unmarshal_int();
/* 33 */     this.createtime = os.unmarshal_int();
/* 34 */     os.unmarshal(this.reason);
/* 35 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 42 */       GRoleForbid o = (GRoleForbid)super.clone();
/* 43 */       o.reason = ((Octets)this.reason.clone());
/* 44 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 47 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleForbid
 * JD-Core Version:    0.6.2
 */