/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class ForbidUserRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public GRoleForbid forbid;
/*    */ 
/*    */   public ForbidUserRes()
/*    */   {
/* 15 */     this.forbid = new GRoleForbid();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.retcode);
/* 21 */     os.marshal(this.forbid);
/* 22 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 27 */     this.retcode = os.unmarshal_int();
/* 28 */     os.unmarshal(this.forbid);
/* 29 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 36 */       ForbidUserRes o = (ForbidUserRes)super.clone();
/* 37 */       o.forbid = ((GRoleForbid)this.forbid.clone());
/* 38 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 41 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.ForbidUserRes
 * JD-Core Version:    0.6.2
 */